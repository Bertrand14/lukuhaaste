<div>
 <label for="reviewContent" class="block font-medium">Arvostelu</label>
 <textarea id="reviewContent" name="reviewContent" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-zinc-500 focus:ring focus:ring-zinc-500 focus:ring-opacity-50 dark:bg-zinc-600" required></textarea>
</div>

<div>
 <label for="note" class="block font-medium">Montako tähteä annat kirjalle?</label>
 <input type="number" id="note" name="note" min="1" max="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-zinc-500 focus:ring focus:ring-zinc-500 focus:ring-opacity-50 dark:bg-zinc-600" required>
</div>

<div>
 <label for="recommend" class="block font-medium">Suositteletko tätä kirjaa?</label>
 <div class="flex items-center space-x-4">
  <label class="inline-flex items-center font-medium">
   <input type="radio" id="recommendTrue" name="recommend" value="true" class="form-radio text-zinc-600" required>
   <span class="ml-2">Yes</span>
  </label>
  <label class="inline-flex items-center font-medium">
   <input type="radio" id="recommendFalse" name="recommend" value="false" class="form-radio text-zinc-600">
   <span class="ml-2">No</span>
  </label>
 </div>
</div>

<div class="flex justify-end">
 <button type="submit" class="inline-flex items-center px-6 py-2 text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-800 rounded-md shadow-md dark:text-zinc-700">
  Tallenna
 </button>
</div>