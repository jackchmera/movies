<template>
    <div>
        <h4 class="text-center">Movies</h4><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Release year</th>
                <th>Cover</th>
                <th>Avg. note</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="movie in movies" :key="movie.id">
                <td>{{ movie.id }}</td>
                <td>{{ movie.title }}</td>
                <td>{{ movie.release_year }}</td>
                <td><img alt="" :src="movie.cover" v-bind:style="{ width: imgWidth + '%' }"/></td>
                <td v-if="movie.avg_note !== null">Note: {{ parseFloat(movie.avg_note) }}</td>
                <td v-else>Note: -</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editmovie', params: { id: movie.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <router-link :to="{name: 'rentmovie', params: { id: movie.id }}" class="btn btn-success">Rent
                        </router-link>
                        <button class="btn btn-danger" @click="deleteMovie(movie.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-info" @click="this.$router.push('/movies/add')">Add Movie</button> 
    </div>
</template>

<script>
export default {
    data() {
        return {
            imgWidth: 25,
            movies: []
        }
    },
    created() {
        this.$axios.get('/api/movies')
            .then(response => {
                this.movies = response.data;
            })
            .catch(function (error) {
                console.error(error);
            });
    },
    methods: {
        deleteMovie(id) {
            this.$axios.delete(`/api/movies/delete/${id}`)
            .then(response => {
                let i = this.movies.map(item => item.id).indexOf(id); // Find index of your object
                this.movies.splice(i, 1)
            })
            .catch(function (error) {
                console.error(error);
            });
        }
    },
}
</script>
