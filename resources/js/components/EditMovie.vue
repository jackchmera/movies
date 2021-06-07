<template>
    <div>
        <h4 class="text-center">Edit Movie</h4>
        <div class="row">
            <div class="col-md-6">
                <MovieForm :movie="movie" :action="updateMovie" :errorList="errorList" button="Update movie" />
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
    name: 'EditMovie',
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
    created() {
        this.$axios.get(`/api/movies/edit/${this.$route.params.id}`)
            .then(response => {
                this.movie = response.data;
            })
            .catch(function (error) {
                console.error(error);
            });
    },
    methods: {
        updateMovie() {
            this.$axios.post(`/api/movies/update/${this.$route.params.id}`, this.movie)
                .then(response => {
                    this.$router.push({name: 'movies'});
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
