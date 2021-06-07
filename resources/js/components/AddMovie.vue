<template>
    <div>
        <h4 class="text-center">Add movie</h4>
        <div class="row">
            <div class="col-md-6">
                <MovieForm :movie="movie" :action="addMovie" :errorList="errorList" button="Add movie" />
            </div>
            <div class="col-md-6">
                <img alt="" :src="movie.cover" v-bind:style="{ width: imgWidth + '%' }"/>
            </div>
        </div>
    </div>
</template>

<script>
import MovieForm from './MovieForm.vue'
    
export default {
    name: 'AddMovie',
    components: {
        MovieForm
    },
    data() {
        return {
            imgWidth: 100,
            movie: {},
            errorList: {}
        }
    },
    methods: {
        addMovie() {
            this.$axios.post('/api/movies/add', this.movie)
                .then(response => {
                    this.$router.push({name: 'movies'})
                })
                .catch(error => {
                    if (error.response.status === 422){
                        this.errorList = error.response.data.errors;
                    }
                    console.error(error);
                });
        }
    }
//    beforeRouteEnter(to, from, next) {
//        next();
//    }
}
</script>
