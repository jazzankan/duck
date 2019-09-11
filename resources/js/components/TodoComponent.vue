<template>
    <div class="todomodal-body">
    <p>{{ detail }}</p>
    </div>
</template>

<script>
    export default {
       name: "todo-detail",
        data() {
            return {
                detail: ''
            }
    },
    methods: {
        getDetail: function (det) {
            this.detail = det;
            return this.detail;
        }
      }
    }
</script>
