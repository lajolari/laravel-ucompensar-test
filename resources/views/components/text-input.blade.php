@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-300 dark:border-gray-500 ' .
               'bg-white dark:bg-gray-100 ' .
               'text-gray-900 dark:text-gray-900 ' .
               'placeholder:text-gray-500 dark:placeholder:text-gray-600 ' .
               'focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'
]) !!}>