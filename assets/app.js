import { createApp } from 'vue';

import AdminProductList from './components/ProductList.vue'; // Renomeado o import
import SalesLeadsList from './components/SalesLeadsList.vue';     // Componente de Leads
import CatalogList from './components/CatalogList.vue';           // Componente de Catálogos
import OrderSeparationList from './components/OrderSeparationList.vue'; // Componente de Pedidos

import './styles/app.css'; // Seu CSS global (se existir)

const app = createApp({
    data() {
        return {
        };
    },
});

app.component('product-list', AdminProductList); // Componente de Produtos (resumo)
app.component('sales-leads-list', SalesLeadsList);     // Componente de Leads
app.component('catalog-list', CatalogList);           // Componente de Catálogos
app.component('order-separation-list', OrderSeparationList); // Componente de Pedidos

app.mount('#app');

console.log('Aplicativo Vue.js do Dashboard do Administrador inicializado (sem Vue Router)!');
