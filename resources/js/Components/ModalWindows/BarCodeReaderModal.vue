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
            @loading="setCanClose(false)"
            @loaded="setCanClose(true)"
            @error="setCanClose(true)"
            style="width: 500px; max-width: 100vw"
        />
    </vue-final-modal>
</template>

<script setup>
import BarCodeReader from '@/Components/BarCodeReader.vue';
import {VueFinalModal} from 'vue-final-modal';
import {ref} from "vue";

const canClose = ref(false);

function setCanClose(value) {
    canClose.value = value;
}

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    }
});
defineEmits(['closed'])
</script>
