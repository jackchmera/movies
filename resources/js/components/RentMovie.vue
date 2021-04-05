<template>
    <div>
        <h4 class="text-center">Rent Movie</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="rentMovie">
                    <div class="form-group">
                        <label>Title</label>
                        <input disabled="disabled" type="text" class="form-control" v-model="movie.title">
                    </div>
                    <div class="form-group">
                        <label>Release year</label>
                        <input disabled="disabled" type="text" class="form-control" v-model="movie.release_year">
                    </div>
                    <div class="form-group">
                        <label>Cover</label>
                        <input disabled="disabled" type="text" class="form-control" v-model="movie.cover">
                    </div>
                    <div class="form-group">
                        <label>Rental date</label>
                        <input type="date" class="form-control" v-model="movie.rental_date">
                    </div>
                    <div class="form-group">
                        <label>Watched</label>
                        <input type="date" class="form-control" v-model="movie.watched">
                    </div>
                    <div class="form-group">
                        <label>Note</label>
                        <select v-model="movie.note">
                            <option v-for="option in options" v-bind:value="option.value">
                                {{ option.text }}
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Rent</button>
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
            movie: {},
            options: [
                { text: 'Pick the note', value: 0 }
            ]
        }
    },
    created() {
            
            let i;
            for (i = 1; i <= 10; i++) {
                this.options.push({ text: i, value: i });
            }
            
            this.$axios.get(`/api/movies/edit/${this.$route.params.id}`)
                .then(response => {
                    this.movie = response.data;
                    this.movie.note = 0;
                })
                .catch(function (error) {
                    console.error(error);
                });
    },
    methods: {
        rentMovie() {
                this.$axios.post(`/api/movies/rent/${this.$route.params.id}/1`, this.movie)
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

