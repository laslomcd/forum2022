<template>
    <div class="d-flex flex-column vote-controls">
        <a @click="voteUp" :title="title('up')" :class="classes">
            <i class="fas fa-caret-up fa-3x"></i>
        </a>
        <span class="votes-count">{{ count }}</span>

        <a @click="voteDown" :title="title('down')" :class="classes">
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
            count: this.model.votes_count || 0,
            id: this.model.id
        }
    },
    computed: {
        classes() {
            return !this.isSignedIn ? 'off' : '';
        },
        endpoint() {
            return `/${this.name}s/${this.id}/vote`;
        }
    },
    methods: {
        title(voteType) {
            let titles = {
                up: `This ${this.name } is useful`,
                down: `This ${this.name } is not useful`,
            }
            return titles[voteType];
        },
        voteUp() {
            this._vote(1);
        },
        voteDown() {
            this._vote(-1);
        },

        _vote(vote) {
            if(!this.signedIn) {
                this.$toast.error(`Please login to vote the ${this.name}`, "Warning", {
                    timeout: 3000,
                    position: 'bottomLeft'
                });
                return;
            }
            axios.post(this.endpoint, {
                vote: vote
            }).then(res => {
                this.$toast.success(res.data.message, "Success", {
                    timeout: 3000,
                    position: 'bottomLeft'
                })
                this.count = res.data.votesCount;
            }).catch(err => console.log(err))
        }

    }
}
</script>

<style scoped>

</style>
