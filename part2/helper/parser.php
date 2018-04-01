<?php
function parseContent($content) {
	$output = array();
	$pattern = '/{subtopic}([\s\S.]*?){\/subtopic}/';
	preg_match_all($pattern, $content, $subtopics);
	if($subtopics[1]) {
		$pattern = '/({header}([\s\S.]*?){\/header})(?:[\s\S.]*?)({notes}([\s\S.]*?){\/notes})/';
		preg_match_all($pattern, $content, $matches);
		if($matches[2] && $matches[4]) {
			$headers = $matches[2];
			$notes = $matches[4];
			for($i = 0; $i < count($headers); $i++) {
				$append['header'] = $headers[$i];
				$data = $notes[$i];
				$pattern = '/{data}([\s\S.]*?){\/data}/';
				preg_match_all($pattern, $data, $matches);
				if($matches[1]) {
					$append['data'] = $matches[1];
				}
				array_push($output, $append);
			}
		}
	}
	return $output;
}

function parseQuiz($content) {
	$output = array();
	$pattern = '/{question}([\s\S.]*?){\/question}/';
	preg_match_all($pattern, $content, $questions);
	$questions = $questions[1];
	if($questions) {
		for($i = 0; $i < count($questions); $i++) {
			$pattern = '/({type}([\s\S.]*?){\/type})(?:[\s\S]*?)({prompt}([\s\S.]*?){\/prompt})([\s\S.]*)/';
			preg_match($pattern, $questions[$i], $matches);
			$append['type'] = $matches[2];
			$append['prompt'] = $matches[4];
			$rest = $matches[5];
			if($rest) {
				$pattern = '/([\s\S]*?)({answer}([\s\S.]*?){\/answer})/';
				preg_match($pattern, $rest, $matches);
				$append['answer'] = $matches[3];
				$choices = $matches[1];
				if ($choices) {
					$pattern = '/{choice}([\s\S.]*?){\/choice}/';
					preg_match_all($pattern, $choices, $matches);
					$choices = $matches[1];
					$choicearray = array();
					foreach($choices as $choice) {
						array_push($choicearray, $choice);
					}
					$append['choices'] = $choicearray;
				}
			}
		array_push($output, $append);
		}
	}
	return $output;
}
