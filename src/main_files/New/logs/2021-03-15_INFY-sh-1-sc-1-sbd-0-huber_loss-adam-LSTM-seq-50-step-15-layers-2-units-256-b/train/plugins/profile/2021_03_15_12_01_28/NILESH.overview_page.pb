?	?ZB>hg?@?ZB>hg?@!?ZB>hg?@	dc???+??dc???+??!dc???+??"h
=type.googleapis.com/tensorflow.profiler.PerGenericStepDetails'??ZB>hg?@L7?A`n?@A??K7??>@Y?j+?????*	??????@2F
Iterator::Model??y?)??!ʼ"??+W@)???1????1w?ug?V@:Preprocessing2j
3Iterator::Model::ParallelMap::Zip[1]::ForeverRepeat?5?;Nё?!}????_@)???H??1j<???	@:Preprocessing2t
=Iterator::Model::ParallelMap::Zip[0]::FlatMap[0]::Concatenate?ZӼ???!?ƺjW@)??ׁsF??16h?e?&??:Preprocessing2S
Iterator::Model::ParallelMap???Q?~?!ĔyEL???)???Q?~?1ĔyEL???:Preprocessing2?
MIterator::Model::ParallelMap::Zip[0]::FlatMap[0]::Concatenate[0]::TensorSlice"??u??q?!K?Z??)"??u??q?1K?Z??:Preprocessing2X
!Iterator::Model::ParallelMap::ZipΈ?????!Z3ԝ5C@)?q????o?12??)????:Preprocessing2d
-Iterator::Model::ParallelMap::Zip[0]::FlatMap???H??!j<???	@)_?Q?[?1m???qe??:Preprocessing2v
?Iterator::Model::ParallelMap::Zip[1]::ForeverRepeat::FromTensor?~j?t?X?!?.?	???)?~j?t?X?1?.?	???:Preprocessing:?
]Enqueuing data: you may want to combine small input data chunks into fewer but larger chunks.
?Data preprocessing: you may increase num_parallel_calls in <a href="https://www.tensorflow.org/api_docs/python/tf/data/Dataset#map" target="_blank">Dataset map()</a> or preprocess the data OFFLINE.
?Reading data from files in advance: you may tune parameters in the following tf.data API (<a href="https://www.tensorflow.org/api_docs/python/tf/data/Dataset#prefetch" target="_blank">prefetch size</a>, <a href="https://www.tensorflow.org/api_docs/python/tf/data/Dataset#interleave" target="_blank">interleave cycle_length</a>, <a href="https://www.tensorflow.org/api_docs/python/tf/data/TFRecordDataset#class_tfrecorddataset" target="_blank">reader buffer_size</a>)
?Reading data from files on demand: you should read data IN ADVANCE using the following tf.data API (<a href="https://www.tensorflow.org/api_docs/python/tf/data/Dataset#prefetch" target="_blank">prefetch</a>, <a href="https://www.tensorflow.org/api_docs/python/tf/data/Dataset#interleave" target="_blank">interleave</a>, <a href="https://www.tensorflow.org/api_docs/python/tf/data/TFRecordDataset#class_tfrecorddataset" target="_blank">reader buffer</a>)
?Other data reading or processing: you may consider using the <a href="https://www.tensorflow.org/programmers_guide/datasets" target="_blank">tf.data API</a> (if you are not using it now)?
:type.googleapis.com/tensorflow.profiler.BottleneckAnalysis?
device?Your program is NOT input-bound because only 0.1% of the total step time sampled is waiting for input. Therefore, you should focus on reducing other time.no*high2B96.3 % of the total step time sampled is spent on All Others time.#You may skip the rest of this page.B?
@type.googleapis.com/tensorflow.profiler.GenericStepTimeBreakdown?
	L7?A`n?@L7?A`n?@!L7?A`n?@      ??!       "      ??!       *      ??!       2	??K7??>@??K7??>@!??K7??>@:      ??!       B      ??!       J	?j+??????j+?????!?j+?????R      ??!       Z	?j+??????j+?????!?j+?????JCPU_ONLY2black"?
device?Your program is NOT input-bound because only 0.1% of the total step time sampled is waiting for input. Therefore, you should focus on reducing other time.b
`input_pipeline_analyzer (especially Section 3 for the breakdown of input operations on the Host)m
ktrace_viewer (look at the activities on the timeline of each Host Thread near the bottom of the trace view)"T
Rtensorflow_stats (identify the time-consuming operations executed on the CPU_ONLY)"Z
Xtrace_viewer (look at the activities on the timeline of each CPU_ONLY in the trace view)*y
w<a href="https://www.tensorflow.org/guide/data_performance" target="_blank">Better performance with the tf.data API</a>2?
=type.googleapis.com/tensorflow.profiler.GenericRecommendationN
nohigh"B96.3 % of the total step time sampled is spent on All Others time.:
Refer to the TF2 Profiler FAQ2"CPU: 