<?php

function simple_pagination($args = []) {
  $args = array_merge($args, [
    'type' => 'array',
    'next_text' => 'Предыдущие записи',
    'prev_text' => 'Следующие записи'
  ]);
  $links = paginate_links($args);

  if (empty($links)) {
    $links = [];
  }

  $output = '<div class="siple-pagination">';

  if (str_contains($links[count($links) - 1], 'class="next page-numbers"')) {
    $output .= $links[count($links) - 1];
  } else {
    $output .= '<span class="next page-numbers">' . (!empty($args['next_text']) ? $args['next_text'] : __( 'Next &raquo;' )) . '</span>';
  }

  if (str_contains($links[0], 'class="prev page-numbers"')) {
    $output .= $links[0];
  } else {
    $output .= '<span class="prev page-numbers">' . (!empty($args['prev_text']) ? $args['prev_text'] : __( '&laquo; Previous' )) . '</span>';
  }

  $output .= '</div>';

  echo $output;
}
