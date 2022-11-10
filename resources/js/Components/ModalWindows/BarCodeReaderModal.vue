<template>
    <vue-final-modal
        v-model="show"
        :z-index-base="1700"
        @closed="v => $emit('closed', v)"
        classes="d-flex justify-content-center align-items-center"
    >
        <bar-code-reader v-if="show" @decode="v => $emit('decode', v)"/>
    </vue-final-modal>
</template>

<script setup>
import BarCodeReader from '@/Components/BarCodeReader.vue';
import {VueFinalModal} from 'vue-final-modal';

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    }
});
defineEmits(['closed', 'loaded', 'decode'])
</script>
