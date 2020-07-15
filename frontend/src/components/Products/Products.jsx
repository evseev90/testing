import React, {useEffect} from "react";
import {useCurrenciesData} from "../../contexts/currenciesContext";
import {useProductsData} from "../../contexts/productsContext";
import Product from "../Product/Product";


const Products = () => {
    const {currencies, setCurrencies, getСurrenciesData} = useCurrenciesData();
    const {products, setProducts, getProductsData} = useProductsData();

    console.log(useCurrenciesData());

    useEffect(() => {
        console.log ('Use effect');
        // let changeCurrencies = setСurrencies({current:1});

    });

    return (
        <>
            <select defaultValue={currencies.current} value={currencies.current}
                    onChange={(e) => { setCurrencies( {currencies: currencies.currencies, current: parseInt(e.target.value)})}}>
                {currencies.currencies && currencies.currencies.map((currency, key) => {
                    return <option value={currency.id}  key={key}>{currency.symbol} - {currency.name}</option>
                })}
            </select>

            <ul>
                {products.products && products.products.map((product, key) => {
                    return <Product {...product} key={key}/>
                })}
            </ul>
        </>
    )
}

export default Products;
