<answer :answer="{{ $answer }}" inline-template>
    <div class="media d-flex post">
        <div class="d-flex flex-column vote-controls">
            @include('shared._vote', ['model' => $answer])
        </div>
        <div class="media-body">
            <form v-if="editing" @submit.prevent="update">
                <div class="form-group">
                    <textarea class="form-control" rows="10" v-model="body" required></textarea>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary" :disabled="isInvalid">Update</button>
                    <button type="button" class="btn btn-danger" @click="cancel">Cancel</button>
                </div>
            </form>
            <div v-else>
                <div v-html="bodyHtml"></div>
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">
                            @can('update', $answer)
                                <a @click.prevent="edit" class="btn btn-sm btn-outline-info">Edit</a>
                            @endcan
                            @can('delete', $answer)
                                <button class="btn btn-sm btn-outline-danger" @click="destroy">Delete</button>
                            @endcan
                        </div>
                    </div>
                    <div class="col-4"></div>
                    <div class="d-flex col-4">
                        <div class="d-flex flex-column">
                            {{--                    @include('shared._author', ['model' => $answer, 'label' => 'Answered'])--}}
                            <user-info :model="{{ $answer }}" label="Answered"></user-info>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</answer>
