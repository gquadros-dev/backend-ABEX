<!-- assets/components/OrderSeparationList.vue -->
<template>
    <div class="card shadow-sm p-4 mt-4">
        <h2 class="text-warning mb-3">Pedidos para Separação</h2>
        <div v-if="loading" class="text-center">
            <div class="spinner-border text-warning" role="status">
                <span class="visually-hidden">Carregando pedidos...</span>
            </div>
            <p class="mt-2">Carregando pedidos...</p>
        </div>
        <div v-else-if="error" class="alert alert-danger" role="alert">
            Erro ao carregar pedidos: {{ error }}
        </div>
        <div v-else>
            <p class="text-muted mb-3">Lista de pedidos aguardando separação e envio.</p>
            <ul class="list-group">
                <li class="list-group-item" v-for="order in orders" :key="order.id">
                    <strong>Pedido #{{ order.id }}</strong> - Cliente: {{ order.clienteNome }} (Status: {{ order.status }})
                    <button class="btn btn-outline-warning btn-sm float-end">Detalhes do Pedido</button>
                </li>
                <li v-if="orders.length === 0" class="list-group-item text-center text-muted">Nenhum pedido para separação.</li>
            </ul>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';

export default {
    name: 'OrderSeparationList',
    setup() {
        const orders = ref([]);
        const loading = ref(true);
        const error = ref(null);

        const fetchOrders = async () => {
            try {
                // Endpoint da API para pedidos pendentes de separação (você precisará criar este controller no Symfony)
                // Supondo um endpoint como /api/pedidos?status=pendente_separacao
                const response = await fetch('/api/pedidos/separacao');
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                orders.value = data;
            } catch (e) {
                error.value = e.message;
                console.error("Erro ao buscar pedidos:", e);
            } finally {
                loading.value = false;
            }
        };

        onMounted(fetchOrders);

        return {
            orders,
            loading,
            error
        };
    }
};
</script>

<style scoped>
/* Estilos específicos do componente */
</style>
