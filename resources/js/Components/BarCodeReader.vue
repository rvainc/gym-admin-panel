<template>
    <div v-bind="$attrs">
        <div v-show="isStatus(STATUS_LOADING)">
            <div class="d-flex justify-content-center align-items-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <div v-show="isStatus(STATUS_ERROR)">
            <div class="w-100 bg-light d-flex justify-content-center align-items-center rounded"
                 style="min-height: 300px">
                <div class="text-muted">Камери не знайдено.</div>
            </div>
        </div>
        <div v-show="isStatus(STATUS_LOADED)">
            <video id="video" class="w-100" style="max-height: 80vh"></video>
            <div class="w-100 d-flex justify-content-center">
                <div v-if="isStatus(STATUS_LOADED)" class="dropdown">
                    <button
                        class="btn btn-secondary dropdown-toggle d-flex align-items-center"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        {{ selected.label }}
                    </button>
                    <ul class="dropdown-menu">
                        <li v-for="item in devices" :key="item.deviceId">
                    <span>
                        <button
                            class="dropdown-item d-flex align-items-center"
                            @click="setCamera(item.deviceId, item.label)"
                        >
                            <div style="width: 10px">
                                <i class="fa-solid fa-check" v-if="selected.id === item.deviceId"></i>
                            </div>
                            <div class="ms-3">{{ item.label }}</div>
                        </button>
                    </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import * as ZXing from "@zxing/library";
import {onMounted, onUnmounted, ref} from "vue";
import _ from "lodash";

const STATUS_LOADING = 'loading';
const STATUS_LOADED = 'loaded';
const STATUS_ERROR = 'error';

const selected = ref(null);
const devices = ref([]);
const status = ref(STATUS_LOADING);

const codeReader = new ZXing.BrowserMultiFormatReader();

onMounted(async () => {
    const lastVideoDevice = JSON.parse(localStorage.getItem('lastVideoInput'));
    devices.value = await codeReader.listVideoInputDevices();

    if (lastVideoDevice && _.find(devices.value, {deviceId: lastVideoDevice.id})) {
        setCamera(lastVideoDevice.id, lastVideoDevice.label)
    } else if (!_.isEmpty(devices.value)) {
        setCamera(devices.value[0].deviceId, devices.value[0].label);
    } else {
        setStatus(STATUS_ERROR);
    }

});

onUnmounted(() => {
    codeReader.reset();
});

function setStatus(val) {
    status.value = val;
    emit(val);
}

function isStatus(value) {
    return status.value === value;
}

function setCamera(id, label = "camera") {
    setStatus(STATUS_LOADING);
    codeReader.reset();
    selected.value = {id, label};

    localStorage.setItem('lastVideoInput', JSON.stringify({
        id: selected.value.id,
        label: selected.value.label,
    }));

    codeReader.decodeFromVideoDevice(selected.value.id, 'video', (result, err) => {
        setStatus(STATUS_LOADED);
        if (result) {
            emit('decode', result)
        }
        if (err && !(err instanceof ZXing.NotFoundException)) {
            setStatus(STATUS_ERROR);
        }
    });
}

const emit = defineEmits([
    'decode',
    'loading',
    'loaded',
    'error',
    'closed',
])
</script>
