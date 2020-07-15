import React from "react";
import {useCurrenciesData} from "../../contexts/currenciesContext";

const Product = (product, currencyId) => {

    const {currencies, setСurrencies, getСurrenciesData} = useCurrenciesData();

    let currency = false;
    for (let cur in currencies.currencies) {
        if (currencies.currencies[cur].id === currencies.current) {
            currency = currencies.currencies[cur];
            break;
        }
    }

    var nf = new Intl.NumberFormat();
     // "1,234,567,890"

    return (
        <li>
            <div className="wrap">
                <div className="img"><img src={product.image}/></div>
                <h3 className="name">{product.name}</h3>
            </div>
            <div className="price">{nf.format(product.price * currency.rate)} {currency && currency.symbol}</div>
        </li>
    )
}

export default Product;
