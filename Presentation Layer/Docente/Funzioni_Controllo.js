function controllaTesto(testo){
				var a=/[a-z]{3,}/gi;
				return a.test(testo);
			}
			
			function controllaEmail(email){
				var a=/\w+@\w+\.\w/i;
				return a.test(email);
			}
			
			function controllaTelefono(numero){
				var a=/\d{9}/;
				return a.test(numero);
			}
			
			function controllaStudio(studio){
				var a=/[%]/;
				return (!a.test(studio));
			}
			
			function controllaRicevimento(ricevimento){
				return ((ricevimento.length>=3 && ricevimento.length<=30));
			}
			
			/*function controllaSSD(studio){
				var a=/[a-z]{3}[\/]{1}\d{3}/gi;
				return a.test(studio);
			}*/
			
			function controllaStato(stato){
				var a=/\d/;
				return a.test(stato);
			}
			
			