<template>
    <FormErrors :errorList="errorList" />
    <form @submit.prevent="action">
        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" v-model="movie.title">
        </div>
        <div class="form-group">
            <label>Release year</label>
            <input type="number" min="1900" max="2099" step="1" class="form-control" v-model="movie.release_year">
        </div>
        <div class="form-group">
            <label>Cover (URL)</label>
            <input type="text" class="form-control" v-model="movie.cover">
        </div>
        <button type="submit" class="btn btn-primary">{{ button }}</button>
        <router-link to="/movies" class="btn btn-warning">Cancel</router-link>
    </form>
</template>

<script>
import FormErrors from './FormErrors.vue'

export default {
    name: 'MovieForm',
    props: ['movie', 'button', 'action', 'errorList'],
    components: {
        FormErrors
    },
    data() {
        return {}
    },
    computed: {}
}
</script>