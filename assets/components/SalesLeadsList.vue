<!-- assets/components/SalesLeadsList.vue -->
<template>
    <div class="card shadow-sm p-4 mt-4">
        <h2 class="text-success mb-3">Leads de Vendas</h2>
        <div v-if="loading" class="text-center">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Carregando leads...</span>
            </div>
            <p class="mt-2">Carregando leads...</p>
        </div>
        <div v-else-if="error" class="alert alert-danger" role="alert">
            Erro ao carregar leads: {{ error }}
        </div>
        <div v-else>
            <p class="text-muted mb-3">Acompanhe novos clientes e oportunidades de venda.</p>
            <ul class="list-group">
                <li class="list-group-item" v-for="lead in leads" :key="lead.id">
                    <strong>{{ lead.nome }}</strong> - {{ lead.email }} (Status: {{ lead.status }})
                    <button class="btn btn-outline-primary btn-sm float-end">Ver Detalhes</button>
                </li>
                <li v-if="leads.length === 0" class="list-group-item text-center text-muted">Nenhum lead encontrado.</li>
            </ul>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';

export default {
    name: 'SalesLeadsList',
    setup() {
        const leads = ref([]);
        const loading = ref(true);
        const error = ref(null);

        const fetchLeads = async () => {
            try {
                // Endpoint da API para leads de vendas (você precisará criar este controller no Symfony)
                const response = await fetch('/api/leads');
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                leads.value = data;
            } catch (e) {
                error.value = e.message;
                console.error("Erro ao buscar leads:", e);
            } finally {
                loading.value = false;
            }
        };

        onMounted(fetchLeads);

        return {
            leads,
            loading,
            error
        };
    }
};
</script>

<style scoped>
/* Estilos específicos do componente */
</style>
