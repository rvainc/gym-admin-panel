<template>
    <div v-show="status === STATUS_LOADING">
        <div
            class="d-flex justify-content-center align-items-center box-500"
        >
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div v-show="status === STATUS_ERROR">
        <div
            class="bg-light d-flex align-items-center rounded box-500"
        >
            <div class="d-block w-100 text-center">
                <div class="text-muted">Жодної камери не знайдено або помилка у відтворенні зображення.</div>
            </div>
        </div>
    </div>
    <span v-show="status === STATUS_LOADED">
        <video id="video" class="box-500"></video>
        <div class="dropdown">
            <button
                class="btn btn-secondary dropdown-toggle d-flex align-items-center"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                {{ selectedLabel }}
            </button>
            <ul class="dropdown-menu">
                <li v-for="item in devices" :key="item.deviceId">
                    <span>
                        <button
                            class="dropdown-item d-flex align-items-center"
                            @click="changeCamera(item.deviceId, item.label)"
                        >
                            <div style="width: 10px">
                                <i class="fa-solid fa-check" v-if="selectedId === item.deviceId"></i>
                            </div>
                            <div class="ms-3">{{ item.label }}</div>
                    </button>
                    </span>
                </li>
            </ul>
        </div>
    </span>
</template>

<script setup>
import * as ZXing from "@zxing/library";
import {onMounted, onUnmounted, ref} from "vue";
import _ from "lodash";

const STATUS_LOADING = 'loading';
const STATUS_LOADED = 'loaded';
const STATUS_ERROR = 'error';

function setStatus(val) {
    status.value = val;
    emit(val);
}

const codeReader = new ZXing.BrowserMultiFormatReader();

const selectedId = ref(null);
const selectedLabel = ref('');
const devices = ref([]);
const status = ref(STATUS_LOADING);

onMounted(() => {
    codeReader.listVideoInputDevices()
        .then(res => {
            devices.value = res;
            if (!_.isEmpty(devices.value)) {
                changeCamera(devices.value[0].deviceId, devices.value[0].label);
            } else {
                setStatus(STATUS_ERROR);
            }
        });
});

onUnmounted(() => {
    codeReader.reset();
});

function changeCamera(cameraId, label = "camera") {
    setStatus(STATUS_LOADING);
    codeReader.reset();
    selectedId.value = cameraId;
    selectedLabel.value = label;

    codeReader.decodeFromVideoDevice(selectedId.value, 'video', (result, err) => {
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
])
</script>

<style scoped>
.box-500 {
    width: 500px;
    height: 500px;
}
</style>
