<?php namespace pwcode\com\theme; ?>
<div>
  <style scoped>
    .pw-field{
      display: flex;
      flex-direction: row;
      align-items: center;
    }
    #pw-service-icon{
      margin-left: 20px;
    }
  </style>
  <div class="pw-field">
    <label for="">Classe: </label>
    <input 
      id='pw-service-icon' 
      type="text"
      name = 'pw-service-icon'
      value = "<?php esc_attr_e(get_post_meta(get_the_ID(), 'pw-service-icon', true)); ?>"  
    >
  </div>
</div>
