<v-upload class='mb-3'                                                                     
    label='{{$label}}'        
    uploadroute='{{$uploadroute}}'                                                    
    v-model='{{'form.'.$field}}'   
    :multiple='{{$multiple}}'   
    :preview='{{$preview}}'   
    :limit='{{$limit}}'   
    listtype='{{$listType}}'                                                      
    accept='{{$accept}}'                                                      
    :errors='{{"errors.$field ? errors.$field : false"}}'                            
/>