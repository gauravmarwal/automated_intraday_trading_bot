	B?f????@B?f????@!B?f????@	r,۳@r,۳@!r,۳@"h
=type.googleapis.com/tensorflow.profiler.PerGenericStepDetails'?B?f????@5^?I?,?@A?MbX	@@Y???T??7@*	????lq?@2F
Iterator::Model?%䃞?7@!????V?X@)??y??7@1?,?V?X@:Preprocessing2j
3Iterator::Model::ParallelMap::Zip[1]::ForeverRepeatX9??v???!??A????)??e?c]??1?Vb?&???:Preprocessing2?
MIterator::Model::ParallelMap::Zip[0]::FlatMap[0]::Concatenate[0]::TensorSlice?? ?rh??!J?i?!??)?? ?rh??1J?i?!??:Preprocessing2S
Iterator::Model::ParallelMap???Q???!( o???)???Q???1( o???:Preprocessing2t
=Iterator::Model::ParallelMap::Zip[0]::FlatMap[0]::Concatenate?U???؟?!???-???)?!??u???1??Nͦ??:Preprocessing2X
!Iterator::Model::ParallelMap::Zipףp=
׳?!i???)/?$???1????	e??:Preprocessing2d
-Iterator::Model::ParallelMap::Zip[0]::FlatMap;?O??n??!??Bm2??)n??t?1?"??????:Preprocessing2v
?Iterator::Model::ParallelMap::Zip[1]::ForeverRepeat::FromTensorF%u?k?!-?.??'??)F%u?k?1-?.??'??:Preprocessing:?
]Enqueuing data: you may want to combine small input data chunks into fewer but larger chunks.
?Data preprocessing: you may increase num_parallel_calls in <a href="https://www.tensorflow.org/api_docs/python/tf/data/Dataset#map" target="_blank">Dataset map()</a> or preprocess the data OFFLINE.
?Reading data from files in advance: you may tune parameters in the following tf.data API (<a href="https://www.tensorflow.org/api_docs/python/tf/data/Dataset#prefetch" target="_blank">prefetch size</a>, <a href="https://www.tensorflow.org/api_docs/python/tf/data/Dataset#interleave" target="_blank">interleave cycle_length</a>, <a href="https://www.tensorflow.org/api_docs/python/tf/data/TFRecordDataset#class_tfrecorddataset" target="_blank">reader buffer_size</a>)
?Reading data from files on demand: you should read data IN ADVANCE using the following tf.data API (<a href="https://www.tensorflow.org/api_docs/python/tf/data/Dataset#prefetch" target="_blank">prefetch</a>, <a href="https://www.tensorflow.org/api_docs/python/tf/data/Dataset#interleave" target="_blank">interleave</a>, <a href="https://www.tensorflow.org/api_docs/python/tf/data/TFRecordDataset#class_tfrecorddataset" target="_blank">reader buffer</a>)
?Other data reading or processing: you may consider using the <a href="https://www.tensorflow.org/programmers_guide/datasets" target="_blank">tf.data API</a> (if you are not using it now)?
:type.googleapis.com/tensorflow.profiler.BottleneckAnalysis?
device?Your program is NOT input-bound because only 2.9% of the total step time sampled is waiting for input. Therefore, you should focus on reducing other time.no*high2B93.2 % of the total step time sampled is spent on All Others time.#You may skip the rest of this page.B?
@type.googleapis.com/tensorflow.profiler.GenericStepTimeBreakdown?
	5^?I?,?@5^?I?,?@!5^?I?,?@      ??!       "      ??!       *      ??!       2	?MbX	@@?MbX	@@!?MbX	@@:      ??!       B      ??!       J	???T??7@???T??7@!???T??7@R      ??!       Z	???T??7@???T??7@!???T??7@JCPU_ONLY