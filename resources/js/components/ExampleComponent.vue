<template>
    <div class="text-xs">
        Example
    </div>
</template>

<script>
    export default {
        data() {
            return {
                courses: [],
                course: {
                    id: '',
                    name: '',
                    description: '',               //Couldn't fetch as sanctum routes denies access, need to check up ASAP
                    duration:''
                },
                course_id: '',
                pagination: {}
            }
        },
        created() {
            this.fetchCourses();
            console.log('Component mounted.');
        },

        methods: {
            fetchCourses() {
                fetch('./api/courses')
                .then(res => res.json())
                .then(res => {
                    console.log(res.data);
                });
            }
        }
    }
</script>
