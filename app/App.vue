<template>
	Enter Number of Players <a-input-number id="inputNumber" v-model:value="noPlayers" @change="getPlayers"/>
	<div v-if="error">
		{{message}}
	</div>
	<div v-else>
		<div v-for="player in players" :key="player.name">
			Player {{ player.name }} : {{player.cards.join(",")}}
		</div>
	</div>
</template>

<script>
import api from './api';
import { defineComponent, ref } from 'vue';
import {InputNumber} from 'ant-design-vue';

export default defineComponent({
	setup() {
		const noPlayers = ref(4);
		const players = ref([]);
		const message = ref('');
		const error = ref(false);

		return {
			noPlayers,
			players,
			message,
			error
		};
	},
	async mounted() {
		await this.load();
	},
	methods: {
		async load() {
			let response = await api.helpGet(`players?noplayers=${this.noPlayers}`);
			if(!response.success) {
				this.message = response.message;
				this.error = true;
				return false;
			}

			this.message = response.message;
			this.error = false;
			this.players = response.data;
		},
		getPlayers(val) {
			this.noPlayers = val;
			this.load();
		}
	}
});
</script>