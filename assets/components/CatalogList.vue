<!-- assets/components/CatalogList.vue -->
<template>
    <div class="card shadow-sm p-4 mt-4">
        <h2 class="text-info mb-3">Catálogos Existentes</h2>
        <div v-if="loading" class="text-center">
            <div class="spinner-border text-info" role="status">
                <span class="visually-hidden">Carregando catálogos...</span>
            </div>
            <p class="mt-2">Carregando catálogos...</p>
        </div>
        <div v-else-if="error" class="alert alert-danger" role="alert">
            Erro ao carregar catálogos: {{ error }}
        </div>
        <div v-else>
            <p class="text-muted mb-3">Gerencie e visualize seus catálogos de produtos.</p>
            <ul class="list-group">
                <li class="list-group-item" v-for="catalog in catalogs" :key="catalog.id">
                    <strong>Catálogo #{{ catalog.id }}</strong> - Última atualização: {{ new Date(catalog.dataAtualizacao).toLocaleDateString() }}
                    <button class="btn btn-outline-info btn-sm float-end">Ver Produtos</button>
                </li>
                <li v-if="catalogs.length === 0" class="list-group-item text-center text-muted">Nenhum catálogo encontrado.</li>
            </ul>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';

export default {
    name: 'CatalogList',
    setup() {
        const catalogs = ref([]);
        const loading = ref(true);
        const error = ref(null);

        const fetchCatalogs = async () => {
            try {
                // Endpoint da API para catálogos (você precisará criar este controller no Symfony)
                const response = await fetch('/api/catalogs');
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                catalogs.value = data;
            } catch (e) {
                error.value = e.message;
                console.error("Erro ao buscar catálogos:", e);
            } finally {
                loading.value = false;
            }
        };

        onMounted(fetchCatalogs);

        return {
            catalogs,
            loading,
            error
        };
    }
};
</script>

<style scoped>
/* Estilos específicos do componente */
</style>
