import React from 'react';
import {routes} from './routes'
import {BrowserRouter, Switch, Route} from "react-router-dom";
import {CurrenciesProvider} from "./contexts/currenciesContext";
import {ProductsProvider} from "./contexts/productsContext";
import './App.css'

export default () => {
    return (
        <BrowserRouter>
            <CurrenciesProvider>
                <ProductsProvider>
                    <Switch>
                        {routes.map((params, key) => (
                            <Route key={key} {...params} />
                        ))}
                    </Switch>
                </ProductsProvider>
            </CurrenciesProvider>
        </BrowserRouter>
    );
};
