<div>
  <style scoped>
    .pw-field{
      display: flex;
      flex-direction: row;
      align-items: center;
    }

    .pw-icon-metabox{
      margin-left: 20px;
    }

  </style>
  <div class="pw-field">
    <label for="">Classe: </label>
    <input 
      class='pw-icon-metabox' 
      type="text"
      name = 'pw-icon'
      value = "<?php esc_attr_e(get_post_meta(get_the_ID(), 'pw-icon', true)); ?>"  
    >
  </div>
</div>