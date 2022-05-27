<template>
    <div>
        <a v-if="canAccept" title="Mark this as Best Answer" :class="classes" @click="markBest">
            <i class="fas fa-check fa-2x mb-2"></i>
        </a>

        <a v-if="accepted" title="This answer has been accepted as best answer" :class="classes">
            <i class="fas fa-check fa-2x mb-2"></i>
        </a>
    </div>
</template>

<script>
export default {
    name: "Accept.vue",
    props: ['answer'],
    data() {
        return {
            isBest: this.answer.isBest,
            id: this.answer.id
        }
    },
    computed: {
        canAccept() {
            return this.authorize('accept', this.answer)
        },
        accepted() {
            return !this.canAccept && this.isBest;
        },
        classes() {
            return [
                'favorite d-flex flex-column mt-2',
                this.isBest ? 'vote-accepted' : ''
            ]
        },
        endpoint() {
            return `/answers/${this.id}/accept`
        }
    },
    methods: {
        markBest() {
            axios.post(this.endpoint)
                .then(res => {
                    this.$toast.success(res.data.message, "Success", {
                        timeout: 3000,
                        position: 'bottomLeft'
                    });
                })
            this.isBest = true;
        }
    }
}
</script>

<style scoped>

</style>
