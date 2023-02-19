<template>
    <footer class="text-center text-secondary container my-5" style="font-size: 12px;">
        ©Universal Sports Academy is an instrument for gyms and other corporations. You can use this in yours own
        corporation.
        Tutorials, references, and examples are constantly reviewed to avoid errors, but we
        cannot warrant full correctness of all content. While using Universal Sports Academy, you agree to have read
        and accepted
        our terms of use, cookie and privacy policy.<br><br>

        Copyright 2022-{{ moment().locale('uk').get('year') }} by rvainc. All Rights Reserved.<br>
        Universal Sports Academy is Powered by USA.CSS.
    </footer>
</template>

<script setup>
import moment from "moment/moment";
</script>
