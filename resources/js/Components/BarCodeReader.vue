<template>
    <div
        v-if="videoDeviceStatus === CAMERA_LOADING"
        class="d-flex justify-content-center align-items-center"
        style="width: 500px; height: 500px"
    >
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div
        v-if="videoDeviceStatus === CAMERA_NOT_LOADED"
        class="alert alert-danger d-flex align-items-center"
        role="alert"
        style="width: 500px; height: 500px"
    >
        <div class="d-block w-100 text-center">
            <div class="h4">Помилка</div>
            <div>Жодної камери не знайдено.</div>
        </div>
    </div>
    <span v-else>
        <video id="video" width="500" height="500"></video>
        <div class="dropdown">
            <button
                class="btn btn-secondary dropdown-toggle d-flex align-items-center"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                <i class="fa-solid fa-check me-2"></i>
                {{ selectedDeviceLabel }}

            </button>
            <ul class="dropdown-menu">
                <li v-for="item in videoInputDevices" :key="item.deviceId">
                    <span v-if="!selectedDeviceId === item.deviceId">
                        <button
                            class="dropdown-item d-flex justify-content-between align-items-center"
                            @click="changeCamera(item.deviceId, item.label)"
                        >
                        {{ item.label }}
                    </button>
                    </span>
                </li>
            </ul>
        </div>
    </span>
</template>

<script setup>
import * as ZXing from "@zxing/library";
import {onMounted, ref} from "vue";
import _ from "lodash";

const CAMERA_LOADING = 'loading';
const CAMERA_LOADED = 'loaded';
const CAMERA_NOT_LOADED = 'not_loaded';

const codeReader = new ZXing.BrowserMultiFormatReader();

const selectedDeviceId = ref(null);
const selectedDeviceLabel = ref('');
const videoInputDevices = ref([]);
const videoDeviceStatus = ref(CAMERA_LOADING);

onMounted(() => {
    codeReader.listVideoInputDevices()
        .then(res => {
            videoInputDevices.value = res;
            if (!_.isEmpty(videoInputDevices.value)) {
                 changeCamera(videoInputDevices.value[0].deviceId, videoInputDevices.value[0].label);
                videoDeviceStatus.value = CAMERA_LOADED;
            } else {
                videoDeviceStatus.value = CAMERA_NOT_LOADED;
            }
        });
});

function changeCamera(cameraId, label="camera") {
    videoDeviceStatus.value = CAMERA_LOADING;
    codeReader.reset();
    selectedDeviceId.value = cameraId;
    selectedDeviceLabel.value = label;

    codeReader.decodeFromVideoDevice(selectedDeviceId.value, 'video', (result, err) => {
        videoDeviceStatus.value = CAMERA_LOADED;
        if (result) {
            emit('decode', result)
        }
        if (err && !(err instanceof ZXing.NotFoundException)) {
            console.error(err);
        }
    })
}

const emit = defineEmits([
    'decode',
])
</script>
