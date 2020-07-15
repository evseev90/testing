import React, {useContext, useState, createContext, useEffect} from 'react';

const CurrenciesContext = createContext({currencies: [], current: 0});

async function getСurrenciesData(setCurrencies) {

    let host = document.location.host.includes('localhost') ? 'http://abistep_test.local' : '';
    await fetch(host + '/api/currencies')
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            setCurrencies(data);
        });
}

function CurrenciesProvider({children}) {
    const [currencies, setCurrencies] = useState([]);
    useEffect(() => {
        if (!currencies || !currencies.length) getСurrenciesData(setCurrencies);
        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, []);

    return (
        <CurrenciesContext.Provider value={{currencies, setCurrencies, getСurrenciesData}}>
            {children}
        </CurrenciesContext.Provider>
    );
}

const useCurrenciesData = () => {
    const context = useContext(CurrenciesContext);
    return context;
};

export {CurrenciesProvider, useCurrenciesData};
