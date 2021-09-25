<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Chat
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <message-container/>
                    <input-message :room="currentRoom"/>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import MessageContainer from './messageContainer.vue'
    import InputMessage from './inputMessage.vue'

    export default defineComponent({
        components: {
            AppLayout,
            MessageContainer,
            InputMessage,
        },
        data:function(){
            return {
                chatRooms:[],
                currentRoom:[],
                messages:[]
            }
        },
        methods:{
            getRooms(){
                axios.get('/chat/rooms').then(res=>{
                    this.chatRooms=res.data;
                    this.setRoom(res.data[0]);
                }).catch(error=>{
                    consol.log(error);
                });
            },
            setRoom(room){
                this.currentRoom=room;
            }
        },
        created(){
            this.getRooms();
        }
    })
</script>
