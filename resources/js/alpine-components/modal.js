
import {focusTrap} from "../utilites/focus-trap.js";

export default () => ({

    isModalOpen: false,
    trapCleanup: null,

    init(){
      this.$watch('isModalOpen', (value) => {
          if(value){
              this.$nextTick(() => {
                  this.trapCleanup = focusTrap(document.querySelector('#dialog'))
                  setTimeout(() => {
                      this.$refs.focusTarget?.focus()
                  }, 150)
              })
          }else{
              this.trapCleanup()
          }
      })


    },

    openModal() {
        this.isModalOpen = true
        this.trapCleanup = focusTrap(document.querySelector('#dialog'))
    },

    closeModal() {
        this.isModalOpen = false
        this.trapCleanup()
    }

});
