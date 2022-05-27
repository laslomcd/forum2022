<template>
    <div class="d-flex flex-column vote-controls">
        <a :title="title('up')" :class="classes">
            <i class="fas fa-caret-up fa-3x"></i>
        </a>
        <span class="votes-count">{{ count }}</span>

        <a :title="title('down')" class="vote-down {{ Auth::guest() ? 'off' : '' }}">
            <i class="fas fa-caret-down fa-3x"></i>
        </a>

        <favorite v-if="name === 'question'" :question="model"></favorite>
        <accept v-else :answer="model"></accept>
    </div>
</template>

<script>
export default {
    name: "Vote.vue",
    props: ['name', 'model'],
    data() {
        return {
            count: this.model.count
        }
    },
    computed: {
        classes() {
            return !this.isSignedIn ? 'off' : '';
        }
    },
    methods: {
        title(voteType) {
            let titles = {
                up: `This ${this.name } is useful`,
                down: `This ${this.name } is not useful`,
            }
            return titles[voteType];
        }
    }
}
</script>

<style scoped>

</style>
