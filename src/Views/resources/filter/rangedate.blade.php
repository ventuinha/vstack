<el-date-picker size='medium' class='w-100' clearable v-model='{{"filter.$index"}}' @change='makeNewRoute'
    type='daterange' :format="'dd/MM/yyyy'" :value-format="'yyyy-MM-dd'" end-placeholder='{{$end_placeholder}}'
    start-placeholder='{{$start_placeholder}}'>
</el-date-picker>