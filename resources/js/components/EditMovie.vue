<template>
    <div>
        <h4 class="text-center">Edit Movie</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateMovie">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" v-model="movie.title">
                    </div>
                    <div class="form-group">
                        <label>Release year</label>
                        <input type="text" class="form-control" v-model="movie.release_year">
                    </div>
                    <div class="form-group">
                        <label>Cover</label>
                        <input type="text" class="form-control" v-model="movie.cover">
                    </div>
                    <button type="submit" class="btn btn-primary">Update movie</button>
                    <router-link to="/movies" class="btn btn-warning">Cancel</router-link>
                </form>
            </div>
            <div class="col-md-6">
                <img alt="" :src="movie.cover" v-bind:style="{ width: imgWidth + '%' }"/>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            imgWidth: 100,
            movie: {}
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
                    .catch(function (error) {
                        console.error(error);
                    });
        }
    },
//    beforeRouteEnter(to, from, next) {
//        next();
//    }
}
</script>
