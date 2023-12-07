<template>
    <div class="search-bar px-0">
        <input
        type="text"
        class="form-control"
        placeholder="Wpisz nazwę miejscowości..."
        v-model="searchTerm"
        @keyup.enter="search"  
        />
        <button class="btn btn-primary d-flex align-items-center" @click="search">Szukaj</button>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
            searchTerm: ''
            };
        },
        methods: {
        search() {
            this.$emit('search', this.searchTerm);
        }
        }
    };
</script>

<style scoped>
.search-bar {
  margin-bottom: 0;
  display: flex;
  justify-content: space-between;
  height:70px;
}

.search-bar input {
    margin-right: 0;
    flex-grow: 1;
    border-radius: unset;
    font-size: 25px;
    background: unset;
    border-bottom: 1px solid var(--color-dark-gray);
    color: var(--color-dark-gray);
    padding: 0 30px;
}

.search-bar button{
    border-radius: 0;
    background-color: var(--color-blue);
    font-size: 25px;
    font-weight: 600;
    padding:0 100px;
}

.search-bar button {
  white-space: nowrap;
}
</style>