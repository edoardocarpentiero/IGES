		function controllaCampo(){
                denominazione=document.getElementById("denominazione");
                regexp = /[0-9!-/]/;
                if(regexp.test(denominazione.value)){
                    n=denominazione.value.length-1;
                    denominazione.value=denominazione.value.substr(0, n);
                }
      }


	  function resettaCFUInsegnamento(){
          document.getElementById("cfuInsegnamento").disabled=false;
          resetCampiIns();
          resettaCampiLab();
      }
      

      function cambioCfu(value,flag){
          if(document.getElementById("corso1").checked)
              calcolaOre(0,flag,value);
          else if(document.getElementById("corso2").checked)
              calcolaOre(1,flag,value);
      }
      

      function resetCampiIns(){
          document.getElementById("oreCorso").value="0 ore";
          document.getElementById("cfuInsegnamento").selectedIndex=0;
      }


      function calcolaOre(corsoScelto,flag,value){
          if(flag==0){
                document.getElementById("oreCorso").value=value*8;
                resettaCampiLab();
          }else if(flag==1){
                if(parseInt(document.getElementById("cfuInsegnamento").value)>parseInt(value)){
                      if(corsoScelto==1)
                          document.getElementById("oreAttivitaLaboratorio").value=value*8;
                      else
                          document.getElementById("oreAttivitaLaboratorio").value=value*10;
                }else{
                    alert("Il numero di CFU inseriti non e' valido");
                    resettaCampiLab();
                }
            }

      }


      function abilita(){
          if(document.getElementById("tipologia").checked)
              document.getElementById("cfuLaboratorio").disabled=false;
          else{
              document.getElementById("cfuLaboratorio").disabled=true;
              resettaCampiLab();
          }
      }


		function controllaDenominazione(){
          denominazione=document.getElementById("denominazione");
          if(denominazione.value.length<=4 || denominazione.value.length==0){
                  alert("Denominazione non valida\nLa lunghezza della denominazione\ndeve essere maggiore di 4!");
                  denominazione.value="";
                  return false;
          }
          return true;
      }
      
      function resettaCampiLab(){
          document.getElementById("cfuLaboratorio").selectedIndex=0;
          document.getElementById("oreAttivitaLaboratorio").value="0 ore";
      }