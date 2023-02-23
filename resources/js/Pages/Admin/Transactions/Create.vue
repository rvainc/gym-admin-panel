<template>
    <authenticated-layout title="Оплата">
        <div class="h5 mb-4 text-truncate">
            Провести транзакцію для
            <Link :href="customer.links.show_url">{{ customer.data.first_name }}</Link>
        </div>
        <form @submit.prevent="form.post(route('admin.transactions.store'))">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="lastNameInput" class="form-label">Дата початку</label>
                        <datepicker
                            v-model="startAt"
                            format="dd.MM.yyyy"
                            locale="uk"
                        ></datepicker>
                        <input-error :message="form.errors.start_at"></input-error>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="phoneNumberInput" class="form-label">Дата кінця</label>
                        <datepicker
                            v-model="form.ends_at"
                            :disabled="Boolean(form.subscription_id)"
                            format="dd.MM.yyyy"
                            locale="uk"
                        ></datepicker>
                        <input-error :message="form.errors.ends_at"></input-error>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-9">
                    <div class="mb-3">
                        <label for="phoneNumberInput" class="form-label">Сума в гривнях</label>
                        <input
                            id="phoneNumberInput"
                            v-model="form.amount"
                            min="0"
                            step="0.01"
                            type="number"
                            class="form-control hide-arrows"
                            :disabled="form.subscription_id"
                        >
                        <input-error :message="form.errors.amount"></input-error>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="mb-3">
                        <label for="lastNameInput" class="form-label">Підписка</label>
                        <vue-select v-model="subscription" :options="subscriptionOptions"></vue-select>
                        <input-error :message="form.errors.subscription_id"></input-error>
                    </div>
                </div>
            </div>
            <div class="mb-2">{{continuanceOfSubscription()}}</div>
            <button type="submit" class="btn btn-primary" :disabled="form.processing">Зберегти</button>
        </form>
    </authenticated-layout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import InputError from "@/Components/Inputs/InputError.vue";
import VueSelect from "vue-select";
import {Link} from "@inertiajs/inertia-vue3";
import {useForm} from '@inertiajs/inertia-vue3'
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import moment from "moment/moment";
import _ from "lodash";
import {computed, ref} from "vue";

function continuanceOfSubscription() {
    const difference = moment(form.ends_at).diff(form.start_at, 'days');
    if (difference > 0) {
        return `Тривалість підписки ${difference} днів.`;
    } else {
        return 'Недопустима тривалість підписки.';
    }
}

function applySubscription(id) {
    let subscription = _.find(props.subscriptions.data, (s) => s.data.id === id);
    form.ends_at = moment(form.start_at).add(subscription.data.days, 'days');
    form.amount = subscription.data.display_price;
    form.subscription_id = subscription.data.id;
    subscriptionTitle.value = subscription.data.title;
}

function clearSubscription() {
    form.subscription_id = null;
    subscriptionTitle.value = null;
}

const subscriptionTitle = ref();
const subscription = computed({
    get: () => subscriptionTitle.value,
    set: value => value ? applySubscription(value.id) : clearSubscription(),
});

const startAt = computed({
   get: () => form.start_at,
   set: (value) => {
       form.start_at = value;
       form.subscription_id ? applySubscription(form.subscription_id) : null;
   }
});

const props = defineProps({
    subscriptions: Object,
    customer: Object,
});

const subscriptionOptions = ref(_.map(props.subscriptions.data, function (v) {
    return {
        label: v.data.title,
        id: v.data.id,
    }
}));

const form = useForm({
    customer_id: props.customer.data.id,
    subscription_id: null,
    amount: 0,
    start_at: moment(),
    ends_at: moment().add(30, 'days')
});
</script>
