import React from 'react'

function Error() {
  return (
    <div className="flex items-baseline my-4">
      <div className="error-banner" role="alert">
        <strong className="font-bold">Holy smokes! </strong>
        <span className="block sm:inline">Something seriously bad happened.</span>
      </div>
    </div>
  )
}

export default Error
