;; greatest
;; return the greatest value in a tup, e.g., (1 3 2) -> 3
(define greatest
  (lambda (tup)
   (cond
    ((null? tup) 0)
    (( > (car tup) (greatest (cdr tup))) (car tup))
    (else (greatest (cdr tup)))
)))

;; positionof
;; you may assume that the given tup actually contains n
;; e.g., (positionof 23 (1 52 23 9)) -> 3
(define positionof
  (lambda (n tup)
   (cond
   ((eq? (car tup) n) 1)
   (else (+ 1 (positionof n (cdr tup))))
)))
;; value
