import React, {useContext, useState, createContext, useEffect} from 'react';

const ProductsContext = createContext({products: []});

async function getProductsData(setData) {
    let host = document.location.host.includes('localhost') ? 'http://abistep_test.local' : '';
    console.log(host);
    await fetch(host + '/api/products')
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            setData(data);
        });
}

function ProductsProvider({children}) {
    const [products, setProducts] = useState([]);
    useEffect(() => {
        if (!products || !products.length) getProductsData(setProducts);
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, []);

    return (
        <ProductsContext.Provider value={{ products, setProducts, getProductsData}}>
            {children}
        </ProductsContext.Provider>
    );
}

const useProductsData = () => {
    const context = useContext(ProductsContext);
    return context;
};

export {ProductsProvider, useProductsData};
