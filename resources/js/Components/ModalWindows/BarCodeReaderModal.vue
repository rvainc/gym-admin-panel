<template>
    <vue-final-modal
        :model-value="show"
        :click-to-close="canClose"
        @closed="emit('closed')"
        class="d-flex justify-content-center align-items-center"
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
import {ref} from "vue";
import {VueFinalModal} from "vue-final-modal";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    }
});

const canClose = ref(false);

function setCanClose(value) {
    canClose.value = value;
}

const emit = defineEmits([
    'closed',
    'decode',
])
</script>
