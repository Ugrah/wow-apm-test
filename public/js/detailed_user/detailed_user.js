const detailed_user = () => {

  associateEventToAllElements(".shadow-sm"  , null , (item) => {


    let itemDataSet = item.dataset ;

    let formId = itemDataSet.smForm ;
    console.log(formId);

/*    AjaxInitialier({
      //frm : dataToBeSentASJSON ,
      link :  baseApiLink + 'forms/'+formId ,
      method : 'GET',
      successCallback : (response) => {
        //console.log('get form  successfully '   , response ) ;
        let data ;
        try{
          data = JSON.parse(response) ;

        }catch(e){

        }
        item.innerHTML = formTemplate({
          ...data,
          formName : data.name
        }) ;

        item.addEventListener('submit' , submitHandler) ;
        item.querySelector(".image-input").addEventListener('change' , fileChangeHnadler) ;
        associateEventToAllElements('.sm_select_bool_controller' , 'click' , booleanTypeEventManager)
      //  item.querySelector('.sm_select_bool_controller').addEventListener('click' , booleanTypeEventManager) ;

      },
      failCallback: () => {
        alert('an error occured') ;

      }
    })
*/     /*

     */

  } ) ;
}

detailed_user()
