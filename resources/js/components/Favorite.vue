<template>
    <a title="Click to Mark as Favorite (Click Again to Undo)"
       :class="classes" @click.prevent="toggle">
        <i class="fas fa-star fa-2x mb-2"></i>
        <span class="favorites-count">{{ count }}</span>
    </a>
</template>

<script>
export default {
    name: "Favorite.vue",
    props:['question'],
    data() {
        return {
            isFavorited: this.question.isFavorited,
            count: this.question.favoritesCount,
            id: this.question.id
        }
    },
    computed: {
        classes() {
            return [
              'favorite d-flex flex-column mt-2',
              ! this.signedIn ? 'off' : (this.isFavorited ? 'favorited' : '')
            ];
        },

        endpoint(){
            return `/questions/${this.id}/favorites`;
        },

     },

    methods: {
        toggle() {
            if (!this.signedIn) {
                this.$toast.warning("Please log in to favorite this question", "Warning", {
                    timeout: 3000,
                    position: 'bottomLeft'
                });
                return;
            }
            this.isFavorited ? this.destroy() : this.create()
        },

        destroy() {
            axios
                .delete(this.endpoint)
                .then(res => {
                    this.count--;
                    this.isFavorited = false;
            })

        },

        create() {
            axios.post(this.endpoint)
                .then(res => {
                    this.count++;
                    this.isFavorited = true;
                })

        }
    }
}
</script>

<style scoped>

</style>
