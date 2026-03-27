import {ref} from "vue";

export default function useSaveItem() {

    const loading = ref(false);
    //const selectedItem = ref(null);
    const errors = ref({});

    async function saveItem(url, data, timeout = 500) {
        errors.value = {};

        loading.value = true;

        const minTime = timeout;

        const start = performance.now();

        try{
            const res = await axios.post(url, data);
            const diff = performance.now() - start;

            if(diff < minTime){
                await wait(minTime - diff);
            }

            return res;

        }catch (e) {

            const diff = performance.now() - start;

            if(diff < minTime) {
                await wait(minTime - diff);
            }

            if(e.response?.status === 422) {
                errors.value = e.response.data.errors;
            }

            console.error(e);

            throw e;
        }

        finally {
            loading.value = false;
        }

    }


    async function wait(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }


    return {
        saveItem,
        loading,
        errors
    }
}
