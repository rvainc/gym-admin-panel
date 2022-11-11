<template>
    <vue-final-modal
        v-model="show"
        :z-index-base="1700"
        @closed="v => $emit('closed', v)"
        :click-to-close="canClose"
        classes="d-flex justify-content-center align-items-center"
    >
        <bar-code-reader
            v-if="show"
            @decode="v => $emit('decode', v)"
            @loading="canClose = false"
            @loaded="canClose = true"
            @error="canClose = true"
        />
    </vue-final-modal>
</template>

<script setup>
import BarCodeReader from '@/Components/BarCodeReader.vue';
import {VueFinalModal} from 'vue-final-modal';
import {ref} from "vue";

const canClose = ref(false);

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    }
});
defineEmits(['closed'])
</script>
