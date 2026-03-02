import {ref} from "vue";

export default function useSaveItem() {

    const loading = ref(false);
    //const selectedItem = ref(null);
    const errors = ref({});

    async function saveItem(url, data) {
        errors.value = {};

        loading.value = true;

        const minTime = 500;

        const start = performance.now();

        try{
            const res = await axios.post(url, data);
            const diff = performance.now() - start;

            if(diff < minTime){
                await wait(minTime - diff);
            }

            return res;


        }catch (e) {
            console.error(e);
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
