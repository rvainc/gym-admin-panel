<script>
import { h } from 'vue';
export default {
    name: "VHtml",
    props: [
      'html'
    ],
    render() {
        return h('div', { innerHTML: this.html });
    }
}
</script>
