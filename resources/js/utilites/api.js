export async function getItems(url) {

    const resp = await axios.get(url);

    return resp.data;


}

export async function getArrayOfItems(url) {

    const resp = await axios.get(url);

    return resp.data.data;


}


export async function saveItems(url, data) {
        const resp = await axios.post(url, data);
        return resp.data;
}


