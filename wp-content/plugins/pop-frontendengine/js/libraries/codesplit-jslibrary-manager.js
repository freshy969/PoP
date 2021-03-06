"use strict";
(function($){
window.popCodeSplitJSLibraryManager = {

	add: false,
	heap: [],
	libraries: {},

	//-------------------------------------------------
	// PUBLIC functions
	//-------------------------------------------------
	documentLoaded : function() {
	// documentInitialized : function() {
	
		var that = this;

		// Once the document is loaded, start adding libraries to the heap
		// Those will be the resourceLoader-loaded resources <= code-splitted ones
		// that.initHeap();
		that.add = true;
	},

	//-------------------------------------------------
	// PUBLIC but NOT EXPOSED functions
	//-------------------------------------------------
	// initHeap : function() {
		
	// 	var that = this;
	// 	that.add = true;
	// },

	assignLibrariesToResource : function(resource) {
		
		var that = this;
		that.libraries[resource] = that.heap;
		that.heap = [];
	},

	getLibraries : function(resource) {
		
		var that = this;
		return that.libraries[resource] || [];
	},

	register : function(library, methods, highPriority, override) {

		var that = this;

		if (that.add) {
			
			// Some JS Objects do "register" twice (eg: popMediaManager)
			if (that.heap.indexOf(library) == -1) {
				that.heap.push(library);
			}
		}
	},

	maybeFilterLibraries : function(method, args) {

		var that = this;

		// If we are passing codeSplitLibraries, then only execute the methods in this subset of JS objectes and not all of them
		// This is needed in integration with code-splitting, so we can execute documentInitializedIndependent not on all dynamically-loaded resources,
		// but only on the specific set of resources that are loaded together for the same URL (eg: mediaManager and mediaManagerCORS will always come together,
		// and their initialization scripts must also be executed together). Then, we avoid a previous batch of resources to execute when
		// only mediaManager had been loaded from a 2nd batch, but before mediaManagerCORS finished loading...
		if (args.codeSplitLibraries) {

			// Calculate the intersection of the two arrays. Solution taken from https://stackoverflow.com/questions/16227197/compute-intersection-of-two-arrays-in-javascript#16227294
			args.libraries = args.libraries.filter(function(n) {
				return args.codeSplitLibraries.indexOf(n) > -1;
			});
		}
	}
};
})(jQuery);

//-------------------------------------------------
// Initialize
//-------------------------------------------------
popJSLibraryManager.register(popCodeSplitJSLibraryManager, ['documentLoaded'/*'documentInitialized'*/], true); // Execute before everything else

