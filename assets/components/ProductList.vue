<!-- assets/components/AdminProductList.vue -->
<template>
    <div class="card shadow-sm p-4 h-100">
        <h2 class="text-primary mb-3">Meus Produtos Recentes</h2>
        <div v-if="loading" class="text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Carregando produtos...</span>
            </div>
            <p class="mt-2">Carregando produtos...</p>
        </div>
        <div v-else-if="error" class="alert alert-danger" role="alert">
            Erro ao carregar produtos: {{ error }}
        </div>
        <div v-else>
            <p class="text-muted mb-3">Os 9 produtos mais recentes da sua loja. Clique em "Visualizar Todos" para gerenciar.</p>

            <div class="product-scroller">
                <div class="product-card-wrapper" v-for="product in displayedProducts" :key="product.id">
                    <div class="card h-100">
                        <img :src="product.fotoPath" class="card-img-top" :alt="product.nome" onerror="this.onerror=null;this.src='https://placehold.co/600x400/CCCCCC/000000?text=Sem+Imagem';">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate mb-1">{{ product.nome }}</h5>

                            <p class="card-text text-muted text-sm mb-2">
                                Venda nos últimos 7 dias: <strong>{{ product.salesLast7Days !== undefined ? product.salesLast7Days : 'N/A' }}</strong> unidades
                            </p>

                            <p class="card-text fw-bold text-success fs-5 mb-2">R$ {{ parseFloat(product.preco).toFixed(2) }}</p>

                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-info text-dark me-2">{{ product.categoria }}</span>
                                <span :class="{'bg-success': product.disponibilidade === 'disponivel', 'bg-danger': product.disponibilidade === 'indisponivel'}" class="badge text-white">
                                    {{ product.disponibilidade === 'disponivel' ? 'Disponível' : 'Indisponível' }}
                                </span>
                            </div>

                            <p class="card-text mt-auto"><small class="text-muted">Estoque: {{ product.estoque }}</small></p>

                            <div class="mt-3">
                                <router-link :to="{ name: 'admin_products_edit_detail', params: { id: product.id } }" class="btn btn-secondary btn-sm me-2">Editar</router-link>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-card-wrapper d-flex align-items-center justify-content-center" v-if="products.length > 9">
                    <router-link :to="{ name: 'admin_products_edit_list' }" class="card h-100 d-flex flex-column justify-content-center align-items-center p-4 text-center text-decoration-none">
                        <h4 class="text-primary">Visualizar Todos</h4>
                        <p class="text-muted">Gerenciar todos os {{ products.length }} produtos</p>
                        <i class="bi bi-arrow-right-circle-fill text-primary fs-1"></i>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted, computed } from 'vue';

export default {
    name: 'AdminProductList',
    setup() {
        const products = ref([]);
        const loading = ref(true);
        const error = ref(null);

        const fetchProducts = async () => {
            try {
                // Buscamos os produtos principais
                const productsResponse = await fetch('/api/produtos?limit=50'); // Buscando mais itens para ter um scroll e um "ver todos"
                if (!productsResponse.ok) {
                    throw new Error(`HTTP error! status: ${productsResponse.status}`);
                }
                const productsData = await productsResponse.json();

                // Buscamos os dados de vendas
                const salesResponse = await fetch('/api/product-sales?days=7');
                if (!salesResponse.ok) {
                    // Se a rota de vendas não existir ainda, apenas loga e continua sem os dados de vendas
                    console.warn("API de vendas de produtos não encontrada ou com erro. Vendas não serão exibidas.", salesResponse.status);
                    const combinedProducts = productsData.map(product => ({
                        ...product,
                        salesLast7Days: 'Erro' // Indicar que não foi possível carregar
                    }));
                    products.value = combinedProducts;
                    return; // Retorna para não tentar combinar
                }
                const salesData = await salesResponse.json(); // Isso será um objeto {produto_id: total_vendido}

                // Combinamos os dados de vendas com os produtos
                const combinedProducts = productsData.map(product => {
                    return {
                        ...product,
                        salesLast7Days: salesData[product.id] || 0 // Adiciona a propriedade salesLast7Days, 0 se não houver vendas
                    };
                });

                products.value = combinedProducts;
            } catch (e) {
                error.value = e.message;
                console.error("Erro ao buscar dados de produtos e vendas:", e);
            } finally {
                loading.value = false;
            }
        };

        // Propriedade computada para exibir apenas os 9 primeiros produtos
        const displayedProducts = computed(() => {
            return products.value.slice(0, 9);
        });

        onMounted(fetchProducts);

        return {
            products,
            loading,
            error,
            displayedProducts
        };
    }
};
</script>

<style scoped>
/* Estilos específicos para este componente */
.product-scroller {
    display: flex; /* Transforma em um container flex */
    overflow-x: auto; /* Habilita a rolagem horizontal quando o conteúdo exceder */
    -webkit-overflow-scrolling: touch; /* Melhora o scroll em dispositivos iOS */
    padding-bottom: 15px; /* Adiciona um padding para a scrollbar não ficar em cima dos cards */
    gap: 1rem; /* Espaçamento entre os cards */
}

.product-scroller::-webkit-scrollbar {
    height: 8px; /* Altura da scrollbar */
}

.product-scroller::-webkit-scrollbar-track {
    background: #f1f1f1; /* Cor do "trilho" da scrollbar */
    border-radius: 10px;
}

.product-scroller::-webkit-scrollbar-thumb {
    background: #888; /* Cor do "polegar" da scrollbar */
    border-radius: 10px;
}

.product-scroller::-webkit-scrollbar-thumb:hover {
    background: #555; /* Cor ao passar o mouse */
}

.product-card-wrapper {
    flex: 0 0 auto; /* Garante que os itens flex não encolham e mantém o tamanho fixo */
    width: 280px; /* Largura fixa para cada card. Ajuste conforme necessário. */
    max-width: 90%; /* Para responsividade em telas muito pequenas */
}

.card-img-top {
    height: 200px;
    object-fit: cover;
}

/* Opcional: Adiciona margem à direita do último item para não "colar" no final da rolagem */
.product-scroller > :last-child {
    margin-right: 1rem;
}

/* Estilo para o card "Visualizar Todos" */
.product-card-wrapper .card.d-flex {
    border: 2px dashed #0d6efd; /* Borda tracejada */
    color: #0d6efd; /* Cor do texto e ícone */
    transition: all 0.3s ease;
}

.product-card-wrapper .card.d-flex:hover {
    background-color: #e9f3ff; /* Cor de fundo ao passar o mouse */
    transform: translateY(-3px); /* Leve elevação */
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15) !important;
}
</style>
