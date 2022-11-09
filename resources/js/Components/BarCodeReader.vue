<template>
    <vue-final-modal
        v-model="show"
        :z-index-base="1700"
        @closed="v => $emit('closed', v)"
        classes="d-flex justify-content-center align-items-center"
    >
        <stream-barcode-reader
            v-if="show"
            @decode="v => $emit('decode', v)"
            @loaded="v => $emit('loaded', v)"
            style="max-width: 500px;"
        ></stream-barcode-reader>
    </vue-final-modal>
</template>

<script setup>
import {StreamBarcodeReader} from "vue-barcode-reader";
import {VueFinalModal} from 'vue-final-modal';

defineProps({
    show: {
        type: Boolean,
        default: false,
    }
});

defineEmits(['closed', 'loaded', 'decode'])
</script>
