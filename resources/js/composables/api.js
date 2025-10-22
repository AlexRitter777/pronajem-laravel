import {setupCache} from "axios-cache-interceptor/dev";
import Axios from "axios";
import {ref} from "vue";


// Setup cache interceptor
const api = setupCache(Axios.create(), {
    debug: console.log,
    interpretHeader: false,
    ttl: 1000 * 60 * 5,
});

export function useApi(){

    const items = ref([]);
    const pagination = ref({});
    const links = ref([]);
    const loading = ref(false);
    const error = ref(false);

    async function fetchItems(url = 'api/version' , params = {}) {

        loading.value = true;
        try {
            const res = await api.get(url, { params:  params  });
            items.value = res.data.data;
            pagination.value = res.data.meta;
            links.value = res.data.links;
            console.log(res);
        }catch (e) {
           console.error(e);
           console.error(e.response.data.message, e.response.status);
           error.value = true;
        }finally {
           loading.value = false;
        }

    }


    async function deleteItem(url, id) {

        loading.value = true;
        await invalidateCache();
        const res = await api.delete(`${url}/${id}`);
        await fetchItems(url);
        loading.value = false;

        return res;
    }

    async function invalidateCache() {
        await api.storage.clear();
    }

    return {
        fetchItems,
        deleteItem,
        invalidateCache,
        loading,
        items,
        pagination,
        links,
        error
    }

}
